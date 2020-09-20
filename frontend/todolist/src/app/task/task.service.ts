import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders, HttpParams} from '@angular/common/http';
import {Observable} from 'rxjs';
import {environment} from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class TaskService {

  constructor(private http: HttpClient) { }

  public create(categoryId: number, title: string, description: string): Observable<any> {
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json'
      })
    };
    return this.http.post<any>(`${environment.apiUrl}/category/${categoryId}/item`, {category_id: categoryId, title, description}, httpOptions);
  }

  public delete(id: number): Observable<any> {
    let params = new HttpParams();
    params = params.set('id', String(id));
    return this.http.delete<any>(`${environment.apiUrl}/item/${id}`, {params});
  }

  public getTasks(categoryId: number): Observable<any> {
    let params = new HttpParams();
    params = params.set('id', String(categoryId));
    return this.http.get<any>(`${environment.apiUrl}/category/${categoryId}/items`, {params});
  }

  public update(id: number, title: string, description: string): Observable<any> {
    return this.http.put<any>(`${environment.apiUrl}/item/${id}`, {id, title, description});
  }
}
