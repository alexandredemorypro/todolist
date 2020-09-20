import {Component, Input, OnInit, ViewChild} from '@angular/core';
import {AbstractControl, FormBuilder, FormGroup, Validators} from '@angular/forms';
import {SubtaskComponent} from '../subtask/subtask.component';
import {TaskService} from './task.service';
import {ModalService} from '../_modal';


@Component({
  selector: 'app-task',
  templateUrl: './task.component.html',
  styleUrls: ['./task.component.css']
})
export class TaskComponent implements OnInit {
  @Input() categoryId: number;
  @ViewChild(SubtaskComponent) subtasks: SubtaskComponent;

  public tasks: Promise<any>;
  public createTask: boolean;
  public form: FormGroup;
  public loading = false;
  public submitted = false;
  public formUpdate: FormGroup;

  constructor(private taskService: TaskService, private formBuilder: FormBuilder, private modalService: ModalService) { }

  public ngOnInit(): void {
    this.form = this.formBuilder.group({
      categoryId: [this.categoryId, Validators.required],
      title: ['', Validators.required],
      description: ['', Validators.required]
    });
    this.formUpdate = this.formBuilder.group({
      id: ['', Validators.required],
      title: ['', Validators.required],
      description: ['', Validators.required]
    });
    this.tasks = this.taskService.getTasks(this.categoryId).toPromise();
  }

  get f(): { [p: string]: AbstractControl } { return this.form.controls; }
  get fup(): { [p: string]: AbstractControl } { return this.formUpdate.controls; }

  public async onSubmit(): Promise<any> {
    this.submitted = true;

    if (this.form.invalid) {
      return;
    }

    this.loading = true;
    const success = await this.taskService.create(this.f.categoryId.value, this.f.title.value, this.f.description.value).toPromise();
    if (success) {
      this.createTask = false;
      this.loading = false;
      this.f.title.setValue('');
      this.f.description.setValue('');
      this.submitted = false;
      this.tasks = this.taskService.getTasks(this.categoryId).toPromise();
    }

    return success;
  }

  public taskAdd(): void {
    this.createTask = true;
    this.form.controls.categoryId.setValue(this.categoryId);
  }

  public async taskDelete(id: number): Promise<any> {
    const success = await this.taskService.delete(id).toPromise();
    if (success) {
      this.tasks = this.taskService.getTasks(this.categoryId).toPromise();
    }

    return success;
  }

  public async onSubmitUpdate(): Promise<any> {
    this.submitted = true;

    if (this.formUpdate.invalid) {
      return;
    }

    this.loading = true;
    const success = await this.taskService.update(this.fup.id.value, this.fup.title.value, this.fup.description.value).toPromise();
    if (success) {
      this.loading = false;
      this.tasks = this.taskService.getTasks(this.categoryId).toPromise();
      this.submitted = false;
    }

    return success;
  }

  public taskUpdate(task: any): void {
    this.fup.id.setValue(task.id);
    this.fup.title.setValue(task.name);
    this.fup.description.setValue(task.description);
    this.modalService.open('task-update-modal' + task.id);
  }
}
