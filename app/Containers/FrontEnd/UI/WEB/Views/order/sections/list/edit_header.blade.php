<div id="fixed-edit-bars">

    <div class="overlay-edit-bars" onclick="closeEditBars()"></div>

    <div class="edit-bars-wrap">
        <div class="edit-bars-wrapper-body">
            <div class="edit-bars-body">
                <div class="d-flex align-items-center justify-content-between edit-bars-title">
                    <span class="color-00112f font-weight-bold">Chỉnh sửa tiêu đề</span>
                    <a href="javascript:;" class="icon-svg" onclick="closeEditBars()">
                        <span class="color-00112f ">
                            <span role="img" class="anticon delIcon-pj-eVU">
                                <svg width="1em" height="1em" viewBox="0 0 24 24" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"
                                    class="">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.36321 5.36321C5.71469 5.01174 6.28453 5.01174 6.63601 5.36321L11.9996 10.7268L17.3632 5.36321C17.7147 5.01174 18.2845 5.01174 18.636 5.36321C18.9875 5.71469 18.9875 6.28453 18.636 6.63601L13.2724 11.9996L18.636 17.3632C18.9875 17.7147 18.9875 18.2845 18.636 18.636C18.2845 18.9875 17.7147 18.9875 17.3632 18.636L11.9996 13.2724L6.63601 18.636C6.28453 18.9875 5.71469 18.9875 5.36321 18.636C5.01174 18.2845 5.01174 17.7147 5.36321 17.3632L10.7268 11.9996L5.36321 6.63601C5.01174 6.28453 5.01174 5.71469 5.36321 5.36321Z">
                                    </path>
                                </svg>
                            </span>
                        </span>
                    </a>
                </div>
                <p class="color-00112f mb-2">
                    Vui lòng giữ ít nhất 5 tiêu đề
                </p>
                <div class="edit-bars-content">
                    <p class="title">
                        Kéo để sắp xếp hoặc lựa chọn Hiển thị/Ẩn tiêu đề
                    </p>
                    <div class="list-drag">
                        <div class="drag-item disabled-row">
                            <div class="drag-list-item">
                                <div class="drag-list-sort-icon-wrap">
                                    <div class="drag-list-sort-icon"></div>
                                </div>
                                <div class="drag-list-column-cell">
                                    <label class="checkbox-custom" for="id-madonhang">
                                        <span class="checkbox-custom-input">
                                            <input type="checkbox" class="d-none" value="" id="id-madonhang">
                                            <span class="checkbox-custom-icon"></span>
                                        </span>
                                        <span class="checkbox-custom-name">Mã đơn hàng </span>

                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="drag-item">
                            <div class="drag-list-item">
                                <div class="drag-list-sort-icon-wrap">
                                    <div class="drag-list-sort-icon"></div>
                                </div>
                                <div class="drag-list-column-cell">
                                    <label class="checkbox-custom" for="id-nguoiban">
                                        <span class="checkbox-custom-input">
                                            <input type="checkbox" class="d-none" value="" id="id-nguoiban">
                                            <span class="checkbox-custom-icon"></span>
                                        </span>
                                        <span class="checkbox-custom-name">Người bán </span>

                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="edit-bars-footer">
                <div class="d-flex align-items-center justify-content-between">
                    <button type="button" class="btn-themes nocolor-btn">
                        <span>Khôi phục cài đặt mặc định</span>
                    </button>
                    <button type="button" class="btn-themes nocolor-btn">
                        <span>Hủy</span>
                    </button>
                    <button type="button" class="btn-themes color-btn">
                        <span>Thêm</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
