async function register()
{
    btn.onclick = async function () {
        let data = {
            'firstName' : form.firstName.value,
            'lastName' : form.lastName.value,
            'login' : form.login.value,
            'password' : form.password.value,
            'confirm' : form.confirm.value,
            'email' : form.email.value
        }
        const answer = await sendPost('/registration/register', data)
        if (answer.registration) {
            errors.innerHTML += `Успешная регистрация`
            setTimeout(() => {
                window.location.href = '/authentication/index'
            }, 1000)
        } else {
            answer.forEach((value) => {
                errors.innerHTML += `<li>${value}</li>`
            })
            setTimeout(() => {
                errors.innerHTML = ''
            }, 3000)
        }
    }
}
register()