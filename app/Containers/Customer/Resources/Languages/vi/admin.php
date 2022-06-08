<?php 
    return [
        'title' => 'Chủ nhà',
        'list' => [
            'header' => 'Quản lí Chủ nhà',
            'filter_form' => [
                'owner_placeholder' => 'Tìm kiếm chủ nhà',
                'address_placeholder' => 'Địa chỉ',
                'starttime_placeholder' => 'Thời gian đăng ký'
            ],
            'block' => 'Tạm khóa (:number)',
            'thead_owner' => 'Chủ nhà',
            'thead_address' => 'Địa chỉ',
            'thead_latest_building' => 'Công trình gần đây',
            'registration_date' => 'Ngày đăng ký'
        ],
        'add' => [
            'header' => 'Thêm mới Chủ nhà',
            'owner_infor' => 'Thông tin cá nhân',
            'fullname' => 'Họ và tên',
            'fullname_placeholder' => 'Nhập Họ và tên',
            'phone' => 'Số điện thoại',
            'phone_placeholder' => 'Nhập Số điện thoại',
            'email' => 'Email',
            'email_placeholder' => 'Nhập Email',
            'address' => 'Địa chỉ',
            'address_placeholder' => 'Nhập Địa chỉ',
            'success_message' => 'Chủ nhà :string đã được tạo thành công'
        ],
        'edit' => [
            'header' => 'Chỉnh sửa Chủ nhà :string',
            'success_message' => 'Chủ nhà :string đã được cập nhật thành công',
            'success_blockmessage' => 'Khóa Chủ nhà :string thành công',
            'success_unblockmessage' => 'Bỏ khóa Chủ nhà :string thành công',
            'success_activeMessage' => 'Kích hoạt Chủ nhà :string thành công',
            'success_deleteMessage' => 'Xóa Chủ nhà :string thành công',
        ],
        'detail' => [
            'header' => 'Chi tiết chủ nhà  :string',
            'base_information' => 'Thông tin cơ bản',
            'active_infomation' => 'Thông tin hoạt động',
            'avatar' => 'Ảnh đại diện',
            'number_follow' => 'Lượt theo dõi',
            'number_comment' => 'Lượt bình luận',
            'partner_cooperation' => 'Đối tác hợp tác',
            'latest_comment_lable' => 'Đánh giá gần đây',
            'comment' => 'Đánh giá',
            'building' => 'Công trình',
            'action' => 'Thao tác',
            'back' => 'Quay lại trang danh sách Chủ nhà',
            'comment_notfound' => 'Không có dữ liệu bình luận',
            'building_notfound' => 'Không có dữ liệu công trình',
        ],
        'log_message' => [
            'add' => 'Thêm mới chủ nhà :string',
            'update' => 'Cập nhật Chủ nhà :string',
            'block' => 'Khóa chủ nhà :string',
            'unblock' => 'Mở khóa chủ nhà :string',
            'active' => 'Kích hoạt chủ nhà :string'
        ]
    ]
?>