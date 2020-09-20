import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {AuthenticationComponent} from '../authentication/authentication.component';
import {TodolistComponent} from '../todolist/todolist.component';
import {AuthGuard} from '../_guard/auth.guard';


const routes: Routes = [
  { path: '', redirectTo: 'login', pathMatch: 'full' },
  { path: 'login', component: AuthenticationComponent },
  {
    path: 'todolist',
    component: TodolistComponent,
    canActivate: [AuthGuard],
    data: { roles: ['admin'] }
  },
  { path: '**', component: AuthenticationComponent },
];


@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class RoutingModule { }
