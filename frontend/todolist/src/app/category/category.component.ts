import { Component, OnInit } from '@angular/core';
import {Observable} from 'rxjs';
import {AbstractControl, FormBuilder, FormGroup, Validators} from '@angular/forms';
import {CategoryService} from './category.service';
import {ModalService} from '../_modal';

@Component({
  selector: 'app-category',
  templateUrl: './category.component.html',
  styleUrls: ['./category.component.css']
})
export class CategoryComponent implements OnInit {
  public categories: Observable<any>;
  public createCategory: boolean;
  public form: FormGroup;
  public loading = false;
  public submitted = false;
  public formUpdate: FormGroup;

  constructor(
    private categoryService: CategoryService, private formBuilder: FormBuilder, private modalService: ModalService
  ) { }

  ngOnInit(): void {
    this.categories = this.categoryService.getAll();
    this.form = this.formBuilder.group({
      title: ['', Validators.required],
      description: ['', Validators.required]
    });
    this.formUpdate = this.formBuilder.group({
      id: ['', Validators.required],
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
    const success = await this.categoryService.create(this.f.title.value, this.f.description.value).toPromise();
    if (success) {
      this.createCategory = false;
      this.loading = false;
      this.categories = this.categoryService.getAll();
      this.f.title.setValue('');
      this.f.description.setValue('');
      this.submitted = false;
    }

    return success;
  }

  public categoryAdd(): void {
    this.createCategory = true;
  }

  public async categoryDelete(id: number): Promise<any> {
    const success = await this.categoryService.delete(id).toPromise();
    if (success) {
      this.categories = this.categoryService.getAll();
    }

    return success;
  }

  public async onSubmitUpdate(): Promise<any> {
    this.submitted = true;

    if (this.formUpdate.invalid) {
      return;
    }

    this.loading = true;
    const success = await this.categoryService.update(this.fup.id.value, this.fup.title.value, this.fup.description.value).toPromise();
    if (success) {
      this.loading = false;
      this.categories = this.categoryService.getAll();
      this.submitted = false;
    }

    return success;
  }

  public categoryUpdate(category: any): void {
    this.fup.id.setValue(category.id);
    this.fup.title.setValue(category.name);
    this.fup.description.setValue(category.description);
    this.modalService.open('category-update-modal' + category.id);
  }
}
