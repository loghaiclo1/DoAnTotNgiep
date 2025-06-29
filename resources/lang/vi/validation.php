<?php

return [
    'attributes' => [
        'password' => 'Mật khẩu',
        'password_confirmation' => 'Xác nhận mật khẩu',
    ],
    'min' => [
        'numeric' => 'Giá trị :attribute phải lớn hơn hoặc bằng :min.',
        'file' => 'Dung lượng tệp :attribute phải lớn hơn hoặc bằng :min kilobytes.',
        'string' => ':attribute phải có ít nhất :min ký tự.',
        'array' => ':attribute phải có ít nhất :min phần tử.',
    ],
    'required' => ':Attribute là bắt buộc.',
    'confirmed' => ':Attribute không khớp.',
];
