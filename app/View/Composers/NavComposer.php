<?php
 
namespace App\View\Composers;
 
use App\Models\LoaiSanPham;
use App\Models\HangSanXuat;
use Illuminate\View\View;
 
class NavComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $loaisanpham;
    protected $hangsanxuat;
 
    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct(LoaiSanPham $lsp,HangSanXuat $hsx)
    {
        $this->loaisanpham = $lsp;
        $this->hangsanxuat = $hsx;
    }
 
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('navbarlsp', $this->loaisanpham->all());
        $view->with('navbarhsx', $this->hangsanxuat->all());
    }
}