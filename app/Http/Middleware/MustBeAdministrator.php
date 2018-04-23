<?php

namespace App\Http\Middleware;

use Closure;

class MustBeAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user=$request->user();

        if($user &&  in_array($user->name,['Pete','Tim']))
        {
        return $next($request);
        }


        else{


    $msg='Must be an Administrator to complete requested action';
 if(stripos($request->url(),'stockitems'))
{  
    return redirect()->route('stockitems.book')->with('message',$msg); }
 

  if(stripos($request->url(),'orders'))  
{   return redirect()->route('orders.book')->with('message',$msg); }        


}}}


