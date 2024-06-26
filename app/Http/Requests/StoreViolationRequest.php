<?php

namespace App\Http\Requests;

use App\Constants\UserRole;
use App\Utils\AuthUtils;
use Illuminate\Foundation\Http\FormRequest;

class StoreViolationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $role = AuthUtils::getRole(auth()->user());

        return [
            'nip' => $role === UserRole::ADMIN ? 'nullable|numeric|unique:violations,nip' : 'nullable',
            'offender' => 'required|string',
            'class' => $role === UserRole::ADMIN ? 'nullable' : 'nullable',
            'position' => $role === UserRole::ADMIN ? 'nullable' : 'nullable',
            'department' => 'required',
            'type' => 'required',
            'regulation_section' => $role === UserRole::ADMIN ? 'nullable' : 'nullable',
            'regulation_letter' => $role === UserRole::ADMIN ? 'nullable' : 'nullable',
            'regulation_number' => $role === UserRole::ADMIN ? 'nullable' : 'nullable',
            'regulation_year' => $role === UserRole::ADMIN ? 'nullable' : 'nullable',
            'regulation_about' => $role === UserRole::ADMIN ? 'nullable' : 'nullable',
            'date' => 'required|date',
            'place' => 'required',
            'desc' => 'required|string',
            'evidence' => 'required|file|mimes:jpeg,png,gif,pdf,mp4,avi,mov,mp3,wav,zip,rar|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'nip.required' => 'NIP Wajib diisi.',
            'nip.numeric' => 'NIP harus berupa angka.',
            'nip.unique' => 'NIP tersebut sudah terdaftar.',
            'date.required' => 'Tanggal wajib diisi.',
            'place.required' => 'Tempat wajib diisi.',
            'regulation_section.required' => 'Pasal wajib diisi.',
            'regulation_letter.required' => 'Huruf wajib diisi.',
            'regulation_number.required' => 'Nomor wajib diisi.',
            'regulation_year.required' => 'Tahun wajib diisi.',
            'regulation_about.required' => 'Tentang wajib diisi.',
            'date.date' => 'Format tanggal tidak valid.',
            'offender.required' => 'Nama terlapor wajib diisi.',
            'offender.string' => 'Nama terlapor harus berupa teks.',
            'desc.required' => 'Deskripsi pelanggaran wajib diisi.',
            'desc.string' => 'Deskripsi pelanggaran harus berupa teks.',
            'type.required' => 'Jenis kode etik wajib dipilih.',
            'class.required' => 'Pangkat / golongan terlapor wajib dipilih.', // Only for admin
            'position.required' => 'Jabatan terlapor wajib diisi.', // Only for admin
            'department.required' => 'Unit kerja wajib dipilih.',
            'evidence.required' => 'Bukti pelanggaran wajib diunggah.',
            'evidence.file' => 'Bukti pelanggaran harus berupa file.',
            'evidence.mimes' => 'Format file bukti pelanggaran tidak valid. Format yang diperbolehkan: jpeg, png, gif, mp4, avi, mov, zip, rar.',
            'evidence.max' => 'Ukuran file bukti pelanggaran tidak boleh melebihi 10 MB.',
        ];
    }
}
