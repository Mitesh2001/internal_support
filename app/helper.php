<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TicketController;
use App\Models\Contact;
use App\Models\User;

function getTicketStatusName($status_id = null)
{

    $ticket = new TicketController();

    return $status_id ? $ticket->statuses[$status_id] : $ticket->statuses;
}

function getTicketType($type_id = null)
{

    $ticket = new TicketController();

    return $type_id ? $ticket->types[$type_id] : $ticket->types;

}

function getTicketSource($source_id = null)
{

    $ticket = new TicketController();

    return $source_id ? $ticket->sources[$source_id] : $ticket->sources;

}

function getPriorityName($priority_id = null)
{

    $ticket = new TicketController();

    return $priority_id ? $ticket->priorities[$priority_id] : $ticket->priorities;
}

function getUserName($user_id = null)
{
    return $user_id ? User::find($user_id)->name : User::select('name','id')->get();
}

function getContactName($email)
{
    $contact = Contact::where('email',$email)->first();
    return $contact->full_name;
}

function getPriorityBadges($priority_id)
{
    $ticket = new TicketController();

    return $ticket->priority_badges[$priority_id];
}

function getIndustryType($type_id =  null )
{
    $company = new CompanyController();

    return $type_id ? $company->industry_types[$type_id] : $company->industry_types ;
}

function getLanguageList()
{
    $contact = new Contact();
    return $contact->languages;
}
