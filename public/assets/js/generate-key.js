const randomString = (length = 30) => {
    let result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    for (let i = 0; i < length; i++)
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    return result;
}

const form = document.querySelector('form')
form.addEventListener('submit', () => {
    let key = window.localStorage.getItem('key');
    if (!key) {
        window.localStorage.setItem('key', randomString());
    }
})