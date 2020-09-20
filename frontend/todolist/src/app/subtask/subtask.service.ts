import {HttpClient, HttpHeaders, HttpParams} from '@angular/common/http';
import { Injectable } from '@angular/core';
import {Observable} from 'rxjs';
import {environment} from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class SubtaskService {

  constructor(private http: HttpClient) { }

  public getSubtasks(taskId: number): Observable<any> {
    let params = new HttpParams();
    params = params.set('id', String(taskId));
    return this.http.get(`${environment.apiUrl}/item/${taskId}/subitems`, {params});
  }

  public create(taskId: number, title: string, description: string): Observable<any> {
    const httpOptions = {
      headers: new HttpHeaders({
        'Content-Type': 'application/json'
      })
    };
    return this.http.post<any>(`${environment.apiUrl}/item/${taskId}/subitem`, {task_id: taskId, title, description}, httpOptions);
  }

  public delete(id: number): Observable<any> {
    let params = new HttpParams();
    params = params.set('id', String(id));
    return this.http.delete<any>(`${environment.apiUrl}/subitem/${id}`, {params});
  }

  public update(id: number, title: string, description: string): Observable<any> {
    return this.http.put<any>(`${environment.apiUrl}/subitem/${id}`, {id, title, description});
  }
}
