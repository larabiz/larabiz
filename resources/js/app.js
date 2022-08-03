document.addEventListener('DOMContentLoaded', () => {
    Livewire.hook('message.processed', (message, component) => {
        Array.from(document.querySelectorAll('textarea')).forEach((el) => {
            el.style.height = '5px'
            el.style.height = `${el.scrollHeight}px`
        })
    })
})
