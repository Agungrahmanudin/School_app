<?php

namespace App\Imports;

use App\Models\Students;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToCollection, WithHeadingRow
{
    private int $importedCount = 0;
    private array $skippedRows = [];

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            $rowNumber = $index + 2; // +2 karena baris 1 adalah header di Excel

            $nis = trim((string)($row['nis'] ?? $row['nisn'] ?? $row['nomor_induk'] ?? ''));
            $name = trim((string)($row['nama'] ?? $row['name'] ?? $row['nama_siswa'] ?? ''));
            $genderRaw = trim((string)($row['jenis_kelamin'] ?? $row['jk'] ?? $row['gender'] ?? ''));
            $class = trim((string)($row['kelas'] ?? $row['class'] ?? ''));
            $major = trim((string)($row['jurusan'] ?? $row['major'] ?? ''));

            // Abaikan jika baris benar-benar kosong
            if ($nis === '' && $name === '' && $class === '' && $major === '') {
                continue;
            }

            // Validasi field wajib
            if ($nis === '' || $name === '') {
                $this->skippedRows[] = "Baris {$rowNumber}: NIS dan Nama tidak boleh kosong.";
                continue;
            }

            // Normalisasi Jenis Kelamin (L / P)
            $genderUpper = strtoupper($genderRaw);
            if (in_array($genderUpper, ['L', 'LAKI-LAKI', 'LAKI - LAKI', 'LAKI LAKI', 'PRIA', 'MALE', 'M'])) {
                $gender = 'L';
            } elseif (in_array($genderUpper, ['P', 'PEREMPUAN', 'WANITA', 'FEMALE', 'F'])) {
                $gender = 'P';
            } else {
                $gender = 'L'; // Default jika tidak diisi atau format lain
            }

            // Update jika NIS sudah ada, buat baru jika belum ada
            Students::updateOrCreate(
                ['nis' => $nis],
                [
                    'name'   => $name,
                    'gender' => $gender,
                    'class'  => $class ?: '-',
                    'major'  => $major ?: '-',
                ]
            );

            $this->importedCount++;
        }
    }

    public function getImportedCount(): int
    {
        return $this->importedCount;
    }

    public function getSkippedRows(): array
    {
        return $this->skippedRows;
    }
}
