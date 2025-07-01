<?php

return [

    'required' => 'Trường :attribute là bắt buộc.',
    'email' => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
    'confirmed' => 'Trường :attribute không khớp.',
    'min' => [
        'numeric' => ':attribute phải lớn hơn hoặc bằng :min.',
        'file' => ':attribute phải có dung lượng tối thiểu :min KB.',
        'string' => ':attribute phải có ít nhất :min ký tự.',
        'array' => ':attribute phải có ít nhất :min phần tử.',
    ],
    'max' => [
        'numeric' => ':attribute không được lớn hơn :max.',
        'file' => ':attribute không được lớn hơn :max KB.',
        'string' => ':attribute không được vượt quá :max ký tự.',
        'array' => ':attribute không được vượt quá :max phần tử.',
    ],
    'in' => ':attribute đã chọn không hợp lệ.',
    'unique' => ':attribute đã được sử dụng.',
    'regex' => ':attribute không đúng định dạng.',
    'same' => ':attribute và :other phải giống nhau.',
    'size' => [
        'string' => ':attribute phải chứa đúng :size ký tự.',
    ],

    // Các nhãn tiếng Việt cho field
    'attributes' => [
        'Ho' => 'họ',
        'Ten' => 'tên',
        'email' => 'email',
        'role' => 'vai trò',
        'password' => 'mật khẩu',
        'password_confirmation' => 'xác nhận mật khẩu',
    ],
];
