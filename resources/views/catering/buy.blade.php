@extends('layouts.app')

@section('title', 'Buy')

@section('content')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
</script>
<div class="container-buy">
  {{-- Items Checkout --}}
  <div class="table-content">
    <div class="table-items">
      <table>
        <tr>
          <th>Photo</th>
          <th>Name</th>
          <th>Quantity</th>
          <th>Price</th>
        </tr>
        <tr>
          <td><img
              src="{{ $recipe->thumbnail ? asset('storage/'.$recipe->thumbnail) : 'https://via.placeholder.com/400' }}">
          </td>
          <td>{{ $recipe->name }}</td>
          <td>
            <input type="number" id="item-quantity" value="5" min="5" max="500" style="width: 60px;">
          </td>
          <td id="item-price">{{ $recipe->price }}</td>
        </tr>
      </table>
    </div>
  </div>

  {{-- About of Items --}}
  <div class="about-items">
    <div class="desc-items">
      <ul>
        <li>Menu Hidangan Nasi : {{$recipe->mn_hd_nasi}}</li>
        <li>Menu Hidangan Utama : {{$recipe->mn_hd_utama}}</li>
        <li>Menu Hidangan Pelengkap : {{$recipe->mn_hd_pelengkap}}</li>
        <li>Menu Hidangan Sayur : {{$recipe->mn_hd_sayur}}</li>
        <li>Menu Hidangan Minuman : {{$recipe->mn_hd_minuman}}</li>
        <li>Menu Hidangan Penutup : {{$recipe->mn_hd_penutup}}</li>
      </ul>
    </div>
    <h1>Deskripsi Produk</h1>
    <label>{{$recipe->about}}</label>
  </div>

  {{-- Ingredients --}}
  <div class="ingredients-container">
    <div class="ingredients-add">
      <div class="table-ingredients">
        <h1>Tambah Menu</h1>
        <table>
          <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
          </tr>
          @foreach ($ingredients as $ingredient)
          <tr>
            <td>{{ $ingredient->name }}</td>
            <td class="ingredient-price" data-price="{{ $ingredient->price }}">{{ $ingredient->price }}</td>
            <td>
              <input type="number" class="ingredient-quantity" id="ingredient-quantity" min="0" value="0">
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>

  {{-- Proses Checkout --}}
  <div class="ck-container">
    <div class="subtotal">
      <h1>Subtotal</h1>
      <div class="subtotal-row">
        <div class="subtotal-column">
          <h3>Quantity Items</h3>
          <h3 id="subtotal-quantity-items">1</h3>
        </div>
        <div class="subtotal-column">
          <h3>Quantity Ingredients</h3>
          <h3 id="subtotal-quantity-ingredients">0</h3>
        </div>
        <div class="subtotal-column">
          <h3>Total Price</h3>
          <h3 id="subtotal-total-price"></h3>
        </div>
      </div>
    </div>
    <div class="form-customer-container">
      <h2>Form Customer</h2>
      <form action="" class="form-customer">
        <div class="form-input-customer">
          <label>Nama</label>
          <input type="text" id="cus_nama">
        </div>
        <div class="form-input-customer">
          <label>No HP</label>
          <input type="text" id="no_hp">
          <small style="color: red; font-size: 12px;">* Nomor ini akan dihubungin jika terjadi masalah</small>
        </div>
        <div class="form-input-customer">
          <label>Alamat</label>
          <input type="text" id="alamat">
        </div>
        <button>Checkout</button>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const quantityInput = document.getElementById('item-quantity');
    const itemPrice = parseFloat(document.getElementById('item-price').textContent);
    const subtotalQuantityItems = document.getElementById('subtotal-quantity-items');
    const subtotalQuantityIngredients = document.getElementById('subtotal-quantity-ingredients');
    const subtotalTotalPrice = document.getElementById('subtotal-total-price');

    const ingredientQuantityInputs = document.querySelectorAll('.ingredient-quantity');
    const ingredientPriceElements = document.querySelectorAll('.ingredient-price');

    const cusNamaInput = document.getElementById('cus_nama');
    const phoneInput = document.getElementById('no_hp');

    cusNamaInput.addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/[0-9]/g, '');
    });

    phoneInput.addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, '');
      if (value.length > 13) {
        value = value.substring(0, 13);
      }

      let formatted = '';
      if (value.length > 0) {
        formatted = value.substring(0, 4);
        if (value.length > 4) {
          formatted += '-' + value.substring(4, 8);
        }
        if (value.length > 8) {
          formatted += '-' + value.substring(8);
        }
      }
      e.target.value = formatted;
    });

    function updateSubtotal() {
      let itemQuantity = parseInt(quantityInput.value);
      if (isNaN(itemQuantity) || itemQuantity < 5) {
        itemQuantity = 5;
        quantityInput.value = itemQuantity;
      } else if (itemQuantity > 500) {
        itemQuantity = 500;
        quantityInput.value = itemQuantity;
      }
    
      let totalIngredientQuantity = 0;
      let totalIngredientPrice = 0;
    
      ingredientQuantityInputs.forEach((input, index) => {
        let qty = parseInt(input.value);
        if (isNaN(qty) || qty < 0) {
          qty = 0;
          input.value = qty;
        }
        totalIngredientQuantity += qty;
      
        const price = parseFloat(ingredientPriceElements[index].dataset.price);
        totalIngredientPrice += price * qty;
      });
    
      // Calculate total price: (item price * item quantity) + total ingredient price
      const totalPrice = (itemPrice * itemQuantity + totalIngredientPrice);
    
      // Format totalPrice as IDR currency
      const formattedPrice = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
      }).format(totalPrice);
    
      // Update subtotal display
      subtotalQuantityItems.textContent = itemQuantity;
      if (subtotalQuantityIngredients) {
        subtotalQuantityIngredients.textContent = totalIngredientQuantity;
      }
      subtotalTotalPrice.textContent = formattedPrice;
    }

    // Event listeners
    quantityInput.addEventListener('input', updateSubtotal);
    ingredientQuantityInputs.forEach(input => {
      input.addEventListener('input', updateSubtotal);
    });

    // Initialize subtotal on page load
    updateSubtotal();
  });

  // Forms Customer
  document.querySelector('.form-customer').addEventListener('submit', function(e) {
    e.preventDefault();

    // Collect item data
    const itemQuantity = parseInt(document.getElementById('item-quantity').value);
    const itemPrice = parseFloat(document.getElementById('item-price').textContent);
    const itemName = "{{ $recipe->name }}";

    // Collect ingredient data
    const ingredientRows = document.querySelectorAll('.ingredients-add table tr');
    const ingredientQuantities = document.querySelectorAll('.ingredient-quantity');
    const ingredientPrices = document.querySelectorAll('.ingredient-price');

    let items = [];

    // Add main item
    // if (itemQuantity > 0) {
      items.push({
        id: 'recipe-{{ $recipe->id }}',
        price: itemPrice,
        quantity: itemQuantity,
        name: itemName,
      });
    // }

    // Add ingredients
    ingredientQuantities.forEach((input, index) => {
      const qty = parseInt(input.value);
      if (qty > 0) {
        const price = parseFloat(ingredientPrices[index].dataset.price);
        const name = ingredientPrices[index].parentElement.textContent.trim();
        items.push({
          id: 'ingredient-' + index,
          price: price,
          quantity: qty,
          name: name,
        });
      }
    });

    // Calculate gross amount
    let grossAmount = 0;
    items.forEach(item => {
      grossAmount += item.price * item.quantity;
    });

    // Collect customer data
    // const noHp = document.querySelector('input[type="text"]:nth-of-type(1)').value;
    // const alamat = document.querySelector('input[type="text"]:nth-of-type(2)').value;
    const cus_nama = document.getElementById('cus_nama').value;
    const noHp = document.getElementById('no_hp').value.replace(/\D/g, '');
    const alamat = document.getElementById('alamat').value;

    const customer = {
      first_name: cus_nama,
      phone: noHp,
      address: alamat,
    };

    // const payload = {
    //   items: items,
    //   gross_amount: grossAmount,
    //   customer: customer,
    // };
    // console.log("Debug Payload to Backend:");
    // console.log(JSON.stringify(payload, null, 2));

    // Request Snap token from backend
    fetch("{{ route('midtrans.token') }}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
      },
      body: JSON.stringify({
        items: items,
        gross_amount: grossAmount,
        customer: customer,
      }),
    })
    .then(response => response.json())
    .then(data => {
      if (data.snap_token) {
        snap.pay(data.snap_token, {
          onSuccess: function(result){
            alert('Payment success!');
          },
          onPending: function(result){
            alert('Waiting for payment!');
          },
          onError: function(result){
            alert('Payment failed!');
          },
          onClose: function(){
            alert('You closed the popup without finishing the payment');
          }
        });
      } else {
        alert('Failed to get payment token');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Payment error');
    });
  });
</script>

@endsection