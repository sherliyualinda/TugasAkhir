<?php
namespace App\Http\Controllers;

use App\Traits\NavbarTrait;

class BaseController extends Controller
{
  public function __construct()
  {
    $total_notif = NavbarTrait::total_notif();
    $list_notif_display = NavbarTrait::list_notif_display();
    $notif_pesan = NavbarTrait::notif_pesan();
    $notif_group = NavbarTrait::notif_group();
    view()->share(compact('total_notif', 'list_notif_display', 'notif_pesan', 'notif_group'));
  }
}