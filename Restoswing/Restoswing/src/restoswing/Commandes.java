/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package restoswing;

import java.util.ArrayList;

/**
 *
 * @author MB504332
 */
public class Commandes {

    private int id_commande;
    private int id_user;
    private int id_etat;
    private String _date;
    private String total_commande;
    private int type_conso;
    private int total_nb_produit;
    private ArrayList libelle;

    public Commandes(int id_commande, int id_user, int id_etat, String _date, String total_commande, int type_conso, int total_nb_produit, ArrayList libelle) {
        this.id_commande = id_commande;
        this.id_user = id_user;
        this.id_etat = id_etat;
        this._date = _date;
        this.total_commande = total_commande;
        this.type_conso = type_conso;
        this.total_nb_produit = total_nb_produit;
        this.libelle = libelle;
    }

    public int getId_commande() {
        return id_commande;
    }

    public void setId_commande(int id_commande) {
        this.id_commande = id_commande;
    }

    public int getId_user() {
        return id_user;
    }

    public void setId_user(int id_user) {
        this.id_user = id_user;
    }

    public int getId_etat() {
        return id_etat;
    }

    public void setId_etat(int id_etat) {
        this.id_etat = id_etat;
    }

    public String getDate() {
        return _date;
    }

    public void setDate(String _date) {
        this._date = _date;
    }

    public String getTotal_commande() {
        return total_commande;
    }

    public void setTotal_commande(String total_commande) {
        this.total_commande = total_commande;
    }

    public int getType_conso() {
        return type_conso;
    }

    public void setType_conso(int type_conso) {
        this.type_conso = type_conso;
    }

    public int getTotal_nb_produit() {
        return total_nb_produit;
    }

    public void setTotal_nb_produit(int total_nb_produit) {
        this.total_nb_produit = total_nb_produit;
    }

    public ArrayList getLibelle() {
        return libelle;
    }

    public void setLibelle(ArrayList libelle) {
        this.libelle = libelle;
    }

}
