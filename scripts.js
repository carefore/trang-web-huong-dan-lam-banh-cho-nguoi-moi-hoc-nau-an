$(document).ready(function() {
  $('#recipeForm').submit(function(event) {
    event.preventDefault(); // Ngăn chặn gửi form mặc định

    // Lấy dữ liệu từ form
    var recipeData = $(this).serialize();

    // Gửi dữ liệu đến PHP để lưu vào cơ sở dữ liệu
    $.ajax({
      type: 'POST',
      url: 'save_recipe.php',
      data: recipeData,
      success: function(response) {
        // Sau khi lưu thành công, hiển thị thông tin công thức mới
        $('#recipeList').append(response);
        $('#recipeForm')[0].reset(); // Xóa các trường trong form
      }
    });
  });

  // Load danh sách công thức khi trang được tải
  $.ajax({
    type: 'GET',
    url: 'get_recipes.php',
    success: function(response) {
      $('#recipeList').html(response);
    }
  });
});
