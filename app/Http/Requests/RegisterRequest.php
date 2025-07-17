<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cho phép tất cả người dùng gửi request này
    }
    public function rules()
    {
        return [
            'ho' => ['required', 'string', 'max:12', 'regex:/^[\pL\s\-]+$/u'],
            'ten' => ['required', 'string', 'max:12', 'regex:/^[\pL\s\-]+$/u'],
            'email' => ['required', 'email', 'max:255', 'unique:khachhang,Email'],
            'matkhau' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }
    public function messages()
    {
        return [
            'ho.required' => 'Vui lòng nhập họ.',
            'ho.regex' => 'Họ chỉ được chứa chữ cái, không được nhập ký tự đặc biệt hoặc số.',
            'ten.required' => 'Vui lòng nhập tên.',
            'ten.regex' => 'Tên chỉ được chứa chữ cái, không được nhập ký tự đặc biệt hoặc số.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'email.unique' => 'Email đã được sử dụng.',
            'matkhau.required' => 'Vui lòng nhập mật khẩu.',
            'matkhau.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'matkhau.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'ho.max' => 'Họ không được vượt quá :max ký tự.',
            'ten.max' => 'Tên không được vượt quá :max ký tự.',
        ];
    }
    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $response = $this->input('g-recaptcha-response');
            $remoteIp = $this->ip();
            $secret = env('RECAPTCHA_SECRET_KEY');

            $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteIp");
            $captcha_success = json_decode($verify);

            if (!$captcha_success->success) {
                $validator->errors()->add('g-recaptcha-response', 'Xác thực captcha không hợp lệ.');
            }
        });
    }
}
