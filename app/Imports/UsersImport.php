<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class UsersImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use SkipsErrors, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'name'        => $row['name'],
            'email'       => $row['email'],
            'user_id'     => $row['user_id'],
            'category_id' => $row['category_id'],
            'password'    => Hash::make($row['password'] ?? 'password123'),
            'is_admin'    => isset($row['is_admin']) && strtolower($row['is_admin']) === 'yes' ? true : false,
        ]);
    }

    /**
     * Validation rules for each row
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'user_id' => 'required|integer|unique:users,user_id',
            'category_id' => 'required|integer|exists:categories,id',
            'password' => 'nullable|string|min:6',
            'is_admin' => 'nullable|in:yes,no,Yes,No,YES,NO',
        ];
    }

    /**
     * Custom validation messages
     */
    public function customValidationMessages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email already exists',
            'user_id.required' => 'User ID is required',
            'user_id.unique' => 'User ID already exists',
            'category_id.required' => 'Category ID is required',
            'category_id.exists' => 'Category ID does not exist',
        ];
    }
}

