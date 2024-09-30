function validateForm() {
    var title = document.getElementById('title').value;
    var description = document.getElementById('description').value;

    if (title.trim() === '') {
        alert('Title is required');
        return false;
    }

    if (description.trim() === '') {
        alert('Description is required');
        return false;
    }

    return true;
}
