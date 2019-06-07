<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute必须接受。',
    'active_url'           => ':attribute不是有效的 URL。',
    'after'                => ':attribute必须在 :date 之后。',
    'after_or_equal'       => ':attribute必须是:date或者之后',
    'alpha'                => ':attribute只能包含字母。',
    'alpha_dash'           => ':attribute只包含字母数字和横线。',
    'alpha_num'            => ':attribute只能包含字母和数字。',
    'array'                => ':attribute只能是数组。',
    'before'               => ':attribute必须早于 :date.',
    'before_or_equal'      => ':attribute只能早于或者等于 :date.',
    'between'              => [
        'numeric' => ':attribute只能在 :min 和 :max之间',
        'file'    => ':attribute只能有 :min 到 :max 之间KB。',
        'string'  => ':attribute只能有 :min 到 :max 个字符.',
        'array'   => ':attribute只能有 :min 到 :max 个。',
    ],
    'boolean'              => ':attribute只能是 true 或 false.',
    'confirmed'            => ':attribute校验信息不匹配。',
    'date'                 => ':attribute不是有效的日期',
    'date_format'          => ':attribute格式不符 :format。',
    'different'            => ':attribute和 :other 必须不同。',
    'digits'               => ':attribute必须 :digits 数字。',
    'digits_between'       => ':attribute必须在 :min 和 :max 之间的数字。',
    'dimensions'           => ':attribute无效的图片尺寸。',
    'distinct'             => ':attribute包含了重复值。',
    'email'                => ':attribute必须是有效的邮件地址。',
    'exists'               => '选中的 :attribute无效。',
    'customer_exists'      => '选中的 :attribute无效。',
    'file'                 => ':attribute必须是文件。',
    'filled'               => ':attribute必填。',
    'image'                => ':attribute必须是图片。',
    'in'                   => '选中的 :attribute无效。',
    'in_array'             => ':attribute在:other中不存在。',
    'integer'              => ':attribute必须是整数。',
    'ip'                   => ':attribute必须是有效的IP地址',
    'ipv4'                 => ':attribute必须是有效的IPv4 地址。',
    'ipv6'                 => ':attribute必须是有效的IPv6 地址。',
    'json'                 => ':attribute必须是有效的JSON 字符串.',
    'max'                  => [
        'numeric' => ':attribute不能大于 :max。',
        'file'    => ':attribute不能多于 :max KB。',
        'string'  => ':attribute不能多于 :max 个字符。',
        'array'   => ':attribute不能多于 :max 个。',
    ],
    'mimes'                => ':attribute只能是 :values类型的文件。',
    'mimetypes'            => ':attribute只能是:values类型文件。',
    'min'                  => [
        'numeric' => ':attribute至少 :min.',
        'file'    => ':attribute至少 :min KB。',
        'string'  => ':attribute至少 :min 个字符。',
        'array'   => ':attribute至少 :min 个。',
    ],
    'not_in'               => '选中的 :attribute无效。',
    'numeric'              => ':attribute只能是数字。',
    'present'              => ':attribute只能是当前时间',
    'regex'                => ':attribute格式无效。',
    'required'             => ':attribute必填项。',
    'required_if'          => '当:other 是 :value时，:attribute必填。',
    'required_unless'      => '除非:other 是:values，否则:attribute必填。',
    'required_with'        => '当:values 存在，:attribute必填。',
    'required_with_all'    => '当:values 存在，:attribute必填。',
    'required_without'     => '当:values 不存在，:attribute必填。',
    'required_without_all' => '当所有:values 不存在，:attribute必填。',
    'same'                 => ':attribute和 :other 不匹配。',
    'size'                 => [
        'numeric' => ':attribute必须是:size.',
        'file'    => ':attribute必须是:size KB。',
        'string'  => ':attribute必须是:size 字符。',
        'array'   => ':attribute必须包含:size 个。',
    ],
    'string'               => ':attribute必须是字符串。',
    'timezone'             => ':attribute必须是有效的区域。',
    'unique'               => ':attribute已经被占用。',
    'customer_unique'      => ':attribute已经被占用。',
    'uploaded'             => ':attribute上传失败。',
    'url'                  => ':attribute格式错误。',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'contact'   =>'联系方式',
        'title'     =>'标题',
        'content'   =>'内容',
        'desc'      =>'描述',
        'tag'       =>'标签',
        'icon'      =>'图标',
        'name'      =>'名称',
        'username'  =>'用户名',
        'status'    =>'状态',
        'email'     =>'邮箱',
        'mobile'    =>'手机',
        'password'  =>'密码',
        'password_confirmation'    =>'重复密码',
    ],
];
