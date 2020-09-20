import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {ReactiveFormsModule} from '@angular/forms';
import { TaskComponent } from './task.component';
import {SubtaskModule} from '../subtask/subtask.module';
import {ModalModule} from '../_modal';



@NgModule({
    declarations: [TaskComponent],
    exports: [
        TaskComponent,
    ],
  imports: [
    CommonModule,
    SubtaskModule,
    ReactiveFormsModule,
    ModalModule,
  ]
})
export class TaskModule { }
