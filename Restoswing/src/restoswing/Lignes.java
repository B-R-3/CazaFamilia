/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package restoswing;

/**
 *
 * @author MB504332
 */
public class Lignes {
    private int id_ligne_commande;
    private int id_commande;
    private int id_produit;
    private int qte;
    private String total_ligne_ht;
    private String libelle;

    public Lignes(int id_ligne_commande, int id_commande, int id_produit, int qte, String total_ligne_ht, String libelle) {
        this.id_ligne_commande = id_ligne_commande;
        this.id_commande = id_commande;
        this.id_produit = id_produit;
        this.qte = qte;
        this.total_ligne_ht = total_ligne_ht;
        this.libelle = libelle;
    }

    public String getLibelle() {
        return libelle;
    }

    public void setLibelle(String libelle) {
        this.libelle = libelle;
    }

    public int getId_ligne_commande() {
        return id_ligne_commande;
    }

    public void setId_ligne_commande(int id_ligne_commande) {
        this.id_ligne_commande = id_ligne_commande;
    }

    public int getId_commande() {
        return id_commande;
    }

    public void setId_commande(int id_commande) {
        this.id_commande = id_commande;
    }

    public int getId_produit() {
        return id_produit;
    }

    public void setId_produit(int id_produit) {
        this.id_produit = id_produit;
    }

    public int getQte() {
        return qte;
    }

    public void setQte(int qte) {
        this.qte = qte;
    }

    public String getTotal_ligne_ht() {
        return total_ligne_ht;
    }

    public void setTotal_ligne_ht(String total_ligne_ht) {
        this.total_ligne_ht = total_ligne_ht;
    }
    
}
