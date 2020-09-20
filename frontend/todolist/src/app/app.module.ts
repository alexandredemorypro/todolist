import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppComponent } from './app.component';
import {AuthenticationModule} from './authentication/authentication.module';
import {RoutingModule} from './_routing/routing.module';
import {TodolistModule} from './todolist/todolist.module';
import {SubtaskModule} from './subtask/subtask.module';


@NgModule({
  declarations: [
    AppComponent,
  ],
  imports: [
    BrowserModule,
    AuthenticationModule,
    RoutingModule,
    TodolistModule,
    SubtaskModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
