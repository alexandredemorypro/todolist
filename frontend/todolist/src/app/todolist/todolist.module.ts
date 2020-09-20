import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {TodolistComponent} from './todolist.component';
import {CategoryModule} from '../category/category.module';
import {SubtaskModule} from "../subtask/subtask.module";
import {ModalModule} from "../_modal";



@NgModule({
  declarations: [TodolistComponent],
  exports: [
    TodolistComponent,
  ],
  imports: [
    CommonModule,
    CategoryModule,
    SubtaskModule,
    ModalModule,
  ],
})
export class TodolistModule { }
