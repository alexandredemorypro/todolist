import { CommonModule } from '@angular/common';
import {HttpClientModule} from '@angular/common/http';
import { NgModule } from '@angular/core';
import {ReactiveFormsModule} from '@angular/forms';
import { AuthenticationComponent } from './authentication.component';



@NgModule({
  declarations: [AuthenticationComponent],
  exports: [
    AuthenticationComponent
  ],
  imports: [
    CommonModule,
    ReactiveFormsModule,
    HttpClientModule,
  ]
})
export class AuthenticationModule { }
