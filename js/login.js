const input = document.querySelectorAll('input')
const a = document.querySelector('.button')
console.log('检查');
a.addEventListener('click', (e) => {
    console.log('点击了一次');
    if (input[0].value == 'root' && input[1].value == '123456') {
        pass
    }
    else {
        e.preventDefault()
        alert('用户名或密码错误')
    }
})

// 加载动画
