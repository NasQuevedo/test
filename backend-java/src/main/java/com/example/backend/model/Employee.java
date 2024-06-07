package com.example.backend.model;

import java.util.Date;

import jakarta.persistence.*;
import org.springframework.data.annotation.CreatedDate;
import org.springframework.data.jpa.domain.support.AuditingEntityListener;

@Entity
@Table(name = "employees")
@EntityListeners(AuditingEntityListener.class)
public class Employee {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;
    
    @Column(name="nombres")
    private String name;

    @Column(name = "apellidos")
    private String lastName;

    @Column(name = "edad")
    private Integer age;

    @Column(name = "fecha_ingreso")
    private Date startDate;

    @Column(name = "comentarios")
    private String comment;

    @Column(name = "created_at")
    @CreatedDate
    private Date date;

    public Employee() {

    }

    public Employee(Long id, String name, String lastName, Integer age, Date startDate, String comment, Date date) {
        this.id = id;
        this.name = name;
        this.lastName = lastName;
        this.age = age;
        this.startDate = startDate;
        this.comment = comment;
        this.date = date;
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getLastName() {
        return lastName;
    }

    public void setLastName(String lastName) {
        this.lastName = lastName;
    }

    public Integer getAge() {
        return age;
    }

    public void setAge(Integer age) {
        this.age = age;
    }

    public Date getStartDate() {
        return startDate;
    }

    public void setStartDate(Date startDate) {
        this.startDate = startDate;
    }

    public String getComment() {
        return comment;
    }

    public void setComment(String comment) {
        this.comment = comment;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    @Override
    public String toString() {
        return "Employee [id=" + id +", name=" + name + ", lastName=" + lastName + ", age=" + age + ", startDate=" + startDate + ", comment=" + comment + ", date=" + date + "]";
    }
}