function submitForm() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const course = document.getElementById('course').value;
    const batch = document.getElementById('batch').value;
    const qualification = document.getElementById('qualification').value;
    const experience = document.getElementById('experience').value;

    if (name && email && phone && course && batch && qualification && experience) {
        const userData = {
            name: name,
            email: email,
            phone: phone,
            course: course,
            batch: batch,
            qualification: qualification,
            experience: experience
        };

        localStorage.setItem('userData', JSON.stringify(userData));
        window.location.href = 'display.html';
    } else {
        alert('Please fill in all fields');
    }
}
