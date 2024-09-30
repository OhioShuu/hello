// Tạo cấu trúc để lưu trữ các resume
let resumes = JSON.parse(localStorage.getItem('resumes')) || [];

document.getElementById('resumeForm').addEventListener('submit', function (e) {
    e.preventDefault();

    // Lấy dữ liệu từ form
    let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let phone = document.getElementById('phone').value;
    let experience = document.getElementById('experience').value;

    // Xác thực đơn giản
    if (!name || !email || !phone || !experience) {
        alert('Please fill in all fields');
        return;
    }

    // Tạo một resume mới
    let newResume = {
        id: Date.now(),
        name: name,
        email: email,
        phone: phone,
        experience: experience
    };

    // Thêm resume vào mảng và lưu vào localStorage
    resumes.push(newResume);
    localStorage.setItem('resumes', JSON.stringify(resumes));

    // Reset form và cập nhật bảng
    document.getElementById('resumeForm').reset();
    displayResumes();
});

// Hiển thị resume trong bảng
function displayResumes() {
    let tableBody = document.querySelector('#resumeTable tbody');
    tableBody.innerHTML = '';

    resumes.forEach(function (resume) {
        let row = `<tr>
                    <td>${resume.name}</td>
                    <td>${resume.email}</td>
                    <td>${resume.phone}</td>
                    <td>${resume.experience}</td>
                    <td>
                        <button onclick="editResume(${resume.id})">Edit</button>
                        <button onclick="deleteResume(${resume.id})">Delete</button>
                    </td>
                   </tr>`;
        tableBody.innerHTML += row;
    });
}

// Chức năng xóa resume
function deleteResume(id) {
    resumes = resumes.filter(resume => resume.id !== id);
    localStorage.setItem('resumes', JSON.stringify(resumes));
    displayResumes();
}

// Chức năng sửa resume
function editResume(id) {
    let resume = resumes.find(resume => resume.id === id);

    document.getElementById('name').value = resume.name;
    document.getElementById('email').value = resume.email;
    document.getElementById('phone').value = resume.phone;
    document.getElementById('experience').value = resume.experience;

    deleteResume(id);  // Xóa resume hiện tại để có thể cập nhật bằng resume mới
}

// Hiển thị resume khi tải trang
document.addEventListener('DOMContentLoaded', displayResumes);
