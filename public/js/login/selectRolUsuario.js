window.addEventListener('DOMContentLoaded', function () {
    var buttons = $('.btn-login-select-rol');
    var inputRole = $('#rol-seleccionado');

    for (const i of buttons) {
        i.addEventListener('click', function (e) {
            selectRole(e.target.id)
        })
    }

    // $('#button-submit-disabled').on('click', function(){
    //     if(this.dataset.disabled){
    //         Swal.fire({

    //         })
    //     } else {

    //     };
    // });

    function selectRole(roleId){
        for (const button of buttons) {
            if (button.id == roleId) {
                inputRole.val(roleId);
                button.style.backgroundColor = 'rgba(78,79,235,1)';
                button.style.color = 'rgba(245,245,245,1)';
                setRoleInSession(roleId)
                enabledButton()
            } else {
                button.style.backgroundColor = 'rgba(245,245,245,1)';
                button.style.color = 'rgba(78,79,235,1)';
            }
        }
    }

    function enabledButton() {
        document.getElementById('button-submit-disabled').disabled = false;
    }

    function setRoleInSession(roleId) {
        var csrf = document.querySelector('meta[name="csrf-token"]').content;
        $.ajax({
            method: 'post',
            url: '/setear-rol-session/'+roleId,
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrf 
            },
        });
    }
})