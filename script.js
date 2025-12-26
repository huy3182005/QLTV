// Hàm xác nhận xóa
function xacNhanXoa(message) {
    return confirm(message);
}

// Hàm kiểm tra form trống
function kiemTraForm(formId) {
    let form = document.getElementById(formId);
    let inputs = form.getElementsByTagName('input');
    let selects = form.getElementsByTagName('select');
    
    for(let i = 0; i < inputs.length; i++) {
        if(inputs[i].type !== 'submit' && inputs[i].value === '') {
            alert('Vui lòng điền đầy đủ thông tin!');
            inputs[i].focus();
            return false;
        }
    }
    
    for(let i = 0; i < selects.length; i++) {
        if(selects[i].value === '') {
            alert('Vui lòng chọn đầy đủ thông tin!');
            selects[i].focus();
            return false;
        }
    }
    
    return true;
}

// Hàm tìm kiếm trong bảng
function timKiemTable() {
    let input = document.getElementById('timkiem');
    let filter = input.value.toUpperCase();
    let table = document.getElementById('myTable');
    let tr = table.getElementsByTagName('tr');
    
    for(let i = 1; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName('td');
        let found = false;
        
        for(let j = 0; j < td.length; j++) {
            if(td[j]) {
                let txtValue = td[j].textContent || td[j].innerText;
                if(txtValue.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }
        
        if(found) {
            tr[i].style.display = '';
        } else {
            tr[i].style.display = 'none';
        }
    }
}

// Hàm đếm ký tự cho textarea
function demKyTu(textareaId, countId) {
    let textarea = document.getElementById(textareaId);
    let count = document.getElementById(countId);
    
    textarea.addEventListener('input', function() {
        count.textContent = textarea.value.length;
    });
}

// Hàm hiển thị/ẩn mật khẩu
function hienMatKhau(inputId) {
    let input = document.getElementById(inputId);
    if(input.type === 'password') {
        input.type = 'text';
    } else {
        input.type = 'password';
    }
}

// Hàm tính tổng tiền thuê sách
function tinhTongTien() {
    let select = document.getElementById('sach-select');
    let selectedOption = select.options[select.selectedIndex];
    let gia = selectedOption.getAttribute('data-gia');
    
    if(gia) {
        document.getElementById('gia-thue').textContent = parseInt(gia).toLocaleString('vi-VN');
    }
}