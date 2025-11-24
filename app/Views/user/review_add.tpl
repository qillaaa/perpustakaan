{extends file="layout_user.tpl"}

{block name="main_content"}
<div class="container py-5">
    <h2 class="text-center mb-4">⭐ Beri Ulasan: {$book_title|escape}</h2>

    <div class="card shadow-sm p-4 mx-auto" style="max-width: 500px; border-radius:15px;">
        <form action="{$base_url}user/reviews/save" method="post">
            <input type="hidden" name="book_id" value="{$book_id}">

            {if $book_cover}
            <div class="text-center mb-4">
                <img src="{$base_url}uploads/covers/{$book_cover}" alt="{$book_title|escape}" 
                     style="height:220px; width:auto; object-fit:cover; border-radius:10px;">
            </div>
            {/if}

            <!-- Rating bintang -->
            <div class="mb-4 text-center">
                <label class="form-label d-block mb-2 fw-semibold">Rating:</label>
                <div class="rating-stars">
                    {for $i=5 to 1 step -1}
                        <input type="radio" name="rating" id="star{$i}" value="{$i}">
                        <label for="star{$i}" title="{$i} stars">★</label>
                    {/for}
                </div>
            </div>

            <!-- Komentar -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Komentar:</label>
                <textarea name="komentar" class="form-control" rows="4" placeholder="Tulis komentar..." 
                          style="border-radius:10px; resize:none;"></textarea>
            </div>

            <button type="submit" class="btn btn-warning w-100 fw-bold shadow-sm">
                <i class="bi bi-star-fill"></i> Kirim Ulasan
            </button>
        </form>
    </div>
</div>

<style>
/* ====================== Rating Stars ====================== */
.rating-stars {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    font-size: 2.2rem;
    transition: transform 0.2s;
}
.rating-stars input {
    display: none;
}
.rating-stars label {
    cursor: pointer;
    color: #ccc;
    transition: color 0.25s ease-in-out, transform 0.2s ease;
}
.rating-stars label:hover,
.rating-stars label:hover ~ label {
    color: gold;
    transform: scale(1.2);
}
.rating-stars input:checked ~ label {
    color: gold;
}

/* ====================== Card Hover ====================== */
.card:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease-in-out;
}
</style>
{/block}
