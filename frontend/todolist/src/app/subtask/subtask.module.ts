import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import { SubtaskComponent } from './subtask.component';
import {ModalModule} from '../_modal';



@NgModule({
  declarations: [SubtaskComponent],
  exports: [
    SubtaskComponent
  ],
  imports: [
    CommonModule,
    ModalModule,
    FormsModule,
    ReactiveFormsModule,
  ]
})
export class SubtaskModule { }
