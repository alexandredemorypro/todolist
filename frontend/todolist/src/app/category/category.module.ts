import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {ReactiveFormsModule} from '@angular/forms';
import { CategoryComponent } from './category.component';
import {TaskModule} from '../task/task.module';
import {SubtaskModule} from '../subtask/subtask.module';
import {ModalModule} from '../_modal';



@NgModule({
    declarations: [CategoryComponent],
    exports: [
        CategoryComponent
    ],
    imports: [
        CommonModule,
        TaskModule,
        ReactiveFormsModule,
        SubtaskModule,
        ModalModule,
    ]
})
export class CategoryModule { }
