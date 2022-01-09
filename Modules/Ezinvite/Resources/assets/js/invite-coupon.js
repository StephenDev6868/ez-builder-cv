$(document).ready(function() {
    $('#copy_link').click(function($event) {
        const itemInput = document.createElement('input');
        itemInput.type = 'text';
        const content = document.getElementById('link_invite').value;
        itemInput.value = content;
        document.body.appendChild(itemInput);
        itemInput.select();
        const result = document.execCommand('copy');
        if (result) {
            alert('copied!')
        }
        document.body.removeChild(itemInput);
    });
})
