<?php

namespace Domain\Task\Enums;

enum TaskCategory: string
{
	case Chore = 'chore';
	
	case Feature = 'feature';
	
	case Fix = 'fix';

	case ServiceRequest = 'service_request';
}