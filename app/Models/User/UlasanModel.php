<?php 
namespace App\Models\User;

use CodeIgniter\Model;

class UlasanModel extends Model
{
    protected $table      = 'ulasan';
    protected $primaryKey = 'ulasan_id';

    protected $allowedFields = [
        'user_id',
        'book_id',
        'rating',
        'komentar',
        'created_at'
    ];

    protected $returnType = 'array';

    // Jangan auto timestamp, karena tabel hanya ada created_at
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = null;

    protected $validationRules = [
        'user_id'  => 'required|integer',
        'book_id'  => 'required|integer',
        'rating'   => 'required|integer|greater_than[0]|less_than[6]',
        'komentar' => 'permit_empty|string'
    ];

    /**
     * Cek apakah user sudah memberi ulasan untuk buku tertentu
     * @param int $userId
     * @param int $bookId
     * @return bool
     */
    public function hasReview(int $userId, int $bookId): bool
    {
        $result = $this->where('user_id', $userId)
                       ->where('book_id', $bookId)
                       ->first();
        return !empty($result);
    }

    /**
     * Ambil semua ulasan user terbaru
     * @param int $userId
     * @return array
     */
    public function getUserReviews(int $userId): array
    {
        return $this->select('ulasan.*, books.judul AS judul_buku, books.cover')
                    ->join('books', 'books.book_id = ulasan.book_id', 'left')
                    ->where('ulasan.user_id', $userId)
                    ->orderBy('ulasan.created_at', 'DESC')
                    ->findAll();
    }
}
