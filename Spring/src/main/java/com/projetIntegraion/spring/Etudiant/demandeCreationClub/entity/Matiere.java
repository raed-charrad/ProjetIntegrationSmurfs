package com.projetIntegraion.spring.Etudiant.demandeCreationClub.entity;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.ManyToMany;
import javax.persistence.ManyToOne;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;


@Entity
public class Matiere {
    private @Id @GeneratedValue Long id;
    
    @NotNull
	@Size(min = 3, max = 50)
	private String nom;

   @NotNull
   private int semestre;

   @NotNull
   private double coeifficent;
   @NotNull
   @ManyToOne
   private Classe classe;
   @NotNull
   @ManyToOne
   private User enseignant;
    public Matiere() {
    }
    public Matiere(Long id, @NotNull @Size(min = 3, max = 50) String nom, @NotNull int semestre,
            @NotNull double coeifficent, @NotNull Classe classe, @NotNull User enseignant) {
        this.id = id;
        this.nom = nom;
        this.semestre = semestre;
        this.coeifficent = coeifficent;
        this.classe = classe;
        this.enseignant = enseignant;
    }
    public Long getId() {
        return id;
    }
    public void setId(Long id) {
        this.id = id;
    }
    public String getNom() {
        return nom;
    }
    public void setNom(String nom) {
        this.nom = nom;
    }
    public int getSemestre() {
        return semestre;
    }
    public void setSemestre(int semestre) {
        this.semestre = semestre;
    }
    public double getCoeifficent() {
        return coeifficent;
    }
    public void setCoeifficent(double coeifficent) {
        this.coeifficent = coeifficent;
    }
    public Classe getClasse() {
        return classe;
    }
    public void setClasse(Classe classe) {
        this.classe = classe;
    }
    public User getEnseignant() {
        return enseignant;
    }
    public void setEnseignant(User enseignant) {
        this.enseignant = enseignant;
    } 
    

    
   



}
