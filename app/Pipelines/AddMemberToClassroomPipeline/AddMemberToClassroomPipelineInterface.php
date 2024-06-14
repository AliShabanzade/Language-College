<?php

namespace App\Pipelines\AddMemberToClassroomPipeline;

use App\Pipelines\Payroll\PayrollDTO;
use Closure;

interface AddMemberToClassroomPipelineInterface
{
    public function handle( $DTO, Closure $next);

}
