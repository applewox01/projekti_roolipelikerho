function generateInviteCode() {
    var code = generateRandomCode(10);
    var currentDate = new Date().toLocaleDateString('fi');

    var newInviteCodeElement = document.createElement('div');
    newInviteCodeElement.classList.add('invite-code');
    newInviteCodeElement.innerHTML = '<h3>' + code + '</h3><p>Created at: ' + currentDate + '</p>';

    document.getElementById('inviteCodesContainer').appendChild(newInviteCodeElement);
}

function generateRandomCode(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}