{extends file="layout_user.tpl"}

{block name="main_content"}

<style>
.card-item {
    background-color: #fff;
    border: 1px solid #000;
    color: #000;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    border-radius: 12px;
    transition: all 0.2s;
}
.card-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.text-muted {
    color: #555 !important;
}
h6.fw-semibold {
    color: #000;
}
.btn-checkout {
    background-color: #000;
    border-color: #000;
    color: #fff;
    transition: all 0.2s;
}
.btn-checkout:hover {
    background-color: #444;
    border-color: #444;
}
</style>

<div class="container py-5">
  <h2 class="fw-bold mb-4 text-center" style="color:#000;">🛒 Konfirmasi Checkout</h2>

  {if $cartItems|@count > 0}
    <div class="row">
      {foreach from=$cartItems item=item}
        <div class="col-12 mb-3">
          <div class="card-item p-3 d-flex flex-row align-items-center">
            <img src="{if $item.cover}{$base_url}uploads/covers/{$item.cover|escape}{else}{$base_url}assets/img/no-cover.png{/if}" 
                 alt="{$item.judul|default:'Judul Tidak Diketahui'|escape}" 
                 style="width:80px; height:100px; object-fit:cover; border-radius:8px;">
            <div class="ms-3">
              <h6 class="fw-semibold mb-1">{$item.judul|default:'Judul Tidak Diketahui'|escape}</h6>
              <p class="text-muted small mb-0">{$item.penulis|default:'-'|escape}</p>
            </div>
          </div>
        </div>
      {/foreach}
    </div>

    <form method="post" action="{$base_url}user/cart/checkout" class="mt-4 text-center">
      <button type="submit" class="btn btn-checkout btn-lg px-4 shadow-sm">
        <i class="bi bi-bag-check me-1"></i> Konfirmasi Checkout
      </button>
    </form>
  {else}
    <p class="text-center text-muted mt-5">Keranjangmu kosong 😅</p>
  {/if}
</div>

{/block}
