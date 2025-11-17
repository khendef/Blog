<?php

namespace App\Enums;

enum PostStatus:string
{
   case PUBLISHED = 'published';
   case PENDING = 'pending';

   case CANCELED = 'canceled';

}
