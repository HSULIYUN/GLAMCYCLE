function validateForm() {
    var title = document.getElementById('title').value.trim();
    var content = document.getElementById('content').value.trim();
    // 检查标题和内容是否为空
    if (!title || !content) {
        alert("標題和內文是必填項目。");
        return false; // 阻止表单提交
    }
    return true; // 允许表单提交
}

document.getElementById('imageUpload').addEventListener('change', function(e) {
    var file = e.target.files[0];
    if (file && file.type.startsWith('image/')) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var imgElement = document.createElement('img');
            imgElement.src = e.target.result;
            imgElement.style.maxWidth = '100%';  // 限制图片的最大宽度
            imgElement.style.maxHeight = '300px'; // 限制图片的最大高度
            var container = document.getElementById('imagePreview');
            if (!container) {
                container = document.createElement('div');
                container.id = 'imagePreview';
                document.body.appendChild(container);
            }
            container.innerHTML = ''; // 清除之前的预览
            container.appendChild(imgElement); // 添加新的预览图片
        };
        reader.readAsDataURL(file);
    } else {
        alert('请选择一个图片文件。');
    }
});
