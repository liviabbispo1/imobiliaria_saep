<?php
namespace App\Models;
use CodeIgniter\Model;

// Model = representa a tabela no banco
class ImoveisModel extends Model
{
    protected $table = 'IMOVEIS'; // nome da tabela
    protected $primaryKey = 'IMO_ID'; // chave primária

    // Campos permitidos para INSERT/UPDATE
    protected $allowedFields = [
        'IMO_ENDERECO',
        'IMO_ANO',
        'IMO_VALOR', 
        'FK_PRO_ID'
    ];
}