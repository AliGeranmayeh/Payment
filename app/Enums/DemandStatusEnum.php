<?php 

namespace App\Enums;


enum DemandStatusEnum :string {
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case DECLINED = 'declined';
    case PAID = 'paid';
}