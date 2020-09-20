import {Component, OnInit} from '@angular/core';
import {ModalService} from '../_modal';
import {SubtaskService} from './subtask.service';
import {AbstractControl, FormBuilder, FormGroup, Validators} from '@angular/forms';


@Component({
  selector: 'app-subtask',
  templateUrl: './subtask.component.html',
  styleUrls: ['./subtask.component.css']
})
export class SubtaskComponent implements OnInit {
  public subtasks;
  public createSubtask: boolean;
  public form: FormGroup;
  public loading = false;
  public submitted = false;
  public formUpdate: FormGroup;

  constructor(
    private subtaskService: SubtaskService, private modalService: ModalService, private formBuilder: FormBuilder
  ) { }

  ngOnInit(): void {
    this.form = this.formBuilder.group({
      taskId: ['', Validators.required],
      title: ['', Validators.required],
      description: ['', Validators.required]
    });
    this.formUpdate = this.formBuilder.group({
      id: ['', Validators.required],
      taskId: ['', Validators.required],
      title: ['', Validators.required],
      description: ['', Validators.required]
    });
  }

  get f(): { [p: string]: AbstractControl } { return this.form.controls; }
  get fup(): { [p: string]: AbstractControl } { return this.formUpdate.controls; }

  public async onSubmit(): Promise<any> {
    this.submitted = true;

    if (this.form.invalid) {
      return;
    }

    this.loading = true;
    const success = await this.subtaskService.create(this.f.taskId.value, this.f.title.value, this.f.description.value).toPromise();
    if (success) {
      this.createSubtask = false;
      this.loading = false;
      this.subtasks = this.subtaskService.getSubtasks(this.f.taskId.value);
      this.f.title.setValue('');
      this.f.description.setValue('');
      this.submitted = false;
    }

    return success;
  }

  public subtaskAdd(): void {
    this.createSubtask = true;
  }

  public async subtaskDelete(id: number): Promise<any> {
    const success = await this.subtaskService.delete(id).toPromise();
    if (success) {
      this.subtasks = this.subtaskService.getSubtasks(this.f.taskId.value);
    }

    return success;
  }

  public subtaskShow(modalId: string, taskId: number): void {
    this.f.taskId.setValue(taskId);
    this.modalService.open(modalId);
    this.subtasks = this.subtaskService.getSubtasks(taskId);
  }

  public async onSubmitUpdate(): Promise<any> {
    this.submitted = true;

    if (this.formUpdate.invalid) {
      return;
    }

    this.loading = true;
    const success = await this.subtaskService.update(this.fup.id.value, this.fup.title.value, this.fup.description.value).toPromise();
    if (success) {
      this.loading = false;
      this.subtasks = this.subtaskService.getSubtasks(this.fup.taskId.value);
      this.submitted = false;
    }

    return success;
  }

  public subtaskUpdate(subtask: any): void {
    this.fup.id.setValue(subtask.id);
    this.fup.taskId.setValue(subtask.item_id);
    this.fup.title.setValue(subtask.name);
    this.fup.description.setValue(subtask.description);
    this.modalService.open('subtask-update-modal' + subtask.id);
  }
}
