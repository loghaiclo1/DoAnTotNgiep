$(document).ready(function () {
    // Văn học cổ điển
    $(document).on('click', '#vanhoccodien-content .pagination a', function(e) {
      e.preventDefault();
      let page = $(this).attr('href').split('vanHocCoDien_page=')[1];
      fetchVanHocCoDien(page);
    });

    function fetchVanHocCoDien(page) {
      $.ajax({
        url: window.routes.vanHocCoDienAjax + '?vanHocCoDien_page=' + page,
        type: "GET",
        beforeSend: function() {
          $('#vanhoccodien-content').html('<div class="text-center p-3">Đang tải...</div>');
        },
        success: function(data) {
          $('#vanhoccodien-content').html(data.html);
        },
        error: function() {
          alert("Lỗi khi tải dữ liệu!");
        }
      });
    }

    // Tâm lý học
    $(document).on('click', '#tamlyhoc-content .pagination a', function(e) {
      e.preventDefault();
      let page = $(this).attr('href').split('tamLyHoc_page=')[1];
      fetchTamLyHoc(page);
    });

    function fetchTamLyHoc(page) {
      $.ajax({
        url: window.routes.tamLyHocAjax + '?tamLyHoc_page=' + page,
        type: "GET",
        beforeSend: function() {
          $('#tamlyhoc-content').html('<div class="text-center p-3">Đang tải...</div>');
        },
        success: function(data) {
          $('#tamlyhoc-content').html(data.html);
        },
        error: function() {
          alert("Lỗi khi tải dữ liệu Tâm lý học!");
        }
      });
    }

    // Sách thiếu nhi
    $(document).on('click', '#sachthieunhi-content .pagination a', function(e) {
      e.preventDefault();
      let page = $(this).attr('href').split('sachThieuNhi_page=')[1];
      fetchSachThieuNhi(page);
    });

    function fetchSachThieuNhi(page) {
      $.ajax({
        url: window.routes.sachThieuNhiAjax + '?sachThieuNhi_page=' + page,
        type: "GET",
        beforeSend: function() {
          $('#sachthieunhi-content').html('<div class="text-center p-3">Đang tải...</div>');
        },
        success: function(data) {
          $('#sachthieunhi-content').html(data.html);
        },
        error: function() {
          alert("Lỗi khi tải dữ liệu Sách Thiếu Nhi!");
        }
      });
    }
  });
  $(document).on('click', '#sach-hay-container .pagination a', function (e) {
    e.preventDefault();
    let page = $(this).attr('href').split('sachHay_page=')[1];
    let url = $('#sach-hay-container').data('url');

    $.ajax({
      url: url,
      data: { sachHay_page: page },
      success: function (response) {
        $('#sach-hay-container').html(response.html);
      },
      error: function () {
        alert('Lỗi khi tải dữ liệu Sách Hay!');
      }
    });
  });
