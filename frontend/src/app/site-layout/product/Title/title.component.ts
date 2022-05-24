import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-title',
  templateUrl: './title.component.html',
  styleUrls: ['./title.component.css']
})
export class TitleComponent implements OnInit {
  title!: string
  subtitle!: string
  cid!: number
  sid!: number
  constructor(private route: ActivatedRoute) { }

  ngOnInit(): void {
    this.route.params.subscribe(data => {
      this.title = data['cname'];
      this.cid = data['cid'];
      this.sid = data['sid'];
      this.subtitle = data['sname'];
    })
  }
}
