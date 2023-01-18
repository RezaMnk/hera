document.querySelectorAll('.cart-add-count').forEach(element => {
    element.addEventListener('click', async () => {
        await handle_counter(element, 'add');
    })
})

document.querySelectorAll('.cart-remove-count').forEach(element => {
    element.addEventListener('click', async () => {
        await handle_counter(element, 'remove');
    })
})

async function handle_counter(element, action) {
    let counter_box = element.parentElement;
    counter_box.classList.toggle('loading');
    counter_box.querySelector('.cart-count').innerHTML = `
<div class="spinner-grow spinner-grow-sm d-flex" role="status">
  <span class="sr-only">در حال بروزرسانی...</span>
</div>
`
    let response = await change_count(counter_box.getAttribute('data-slug'), action);
    counter_box.querySelector('.cart-count').innerHTML = response.quantity;
    counter_box.classList.toggle('loading');
}

async function change_count(slug, action)
{
    return fetch('/api/cart/'+ action +'/'+ slug, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    }).then((data) => {
        return data.json()
    }).then((data) => {
        update_cart_page();
        return data
    })
}


async function update_cart_page() {
    if (window.location.pathname === '/cart') {
        let cart_total = await update_cart_rows();
        document.querySelector('#total-products-price').innerHTML = cart_total.toLocaleString('en-US') + ' تومان'

        let shipping_price = document.querySelector('td[data-shipping-price]').getAttribute('data-shipping-price')
        document.querySelector('#total-cart-price').innerHTML = (cart_total + (+shipping_price)).toLocaleString('en-US') + ' تومان'
    }
}

async function update_cart_rows() {
    let cart_total = 0;
    for (const element of document.querySelectorAll('tr[data-slug]')) {
        let product = await get_product(element.getAttribute('data-slug'));
        let quantity = element.querySelector('.cart-count').innerHTML;

        let total = (+quantity * product.price)
        cart_total += total;
        element.querySelector('.product-total').innerHTML = total.toLocaleString('en-US')
    }
    return cart_total
}

async function get_product(slug)
{
    return fetch('/api/get-product', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            slug: slug,
        })
    }).then((data) => {
        return data.json()
    }).then((data) => {
        return data
    })
}
