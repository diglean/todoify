<?php

namespace Domain\Task\Enums;

enum TaskStatus:string
{
    case Canceled = 'canceled';

	case Doing = 'doing';

	case Done = 'done';

	case Pending = 'pending';

	case Overdue = 'overdue';
}