#odabir svih korisnika
SELECT * FROM korisnik;

#odabir svih valuta sa nazivom i slikom
SELECT naziv, slika FROM valuta;

#odabir svih moderatora
SELECT * FROM korisnik WHERE tip_korisnika_id = 1;

#odabir naziva i iznosa sredstava korisnika 3
SELECT s.iznos, v.naziv FROM sredstva s, valuta v 
WHERE s.valuta_id=v.valuta_id AND korisnik_id=3

#odabir svih valuta koje su ažurirane prije 08.11.2019 za koje je zadužen moderator 2 
SELECT * FROM valuta WHERE moderator_id=2 AND datum_azuriranja<'2019-11-08'

#odabir svih valuta koje se trenutno smiju prodavati ako je sada '13:05' za moderatora 2 
SELECT * FROM valuta WHERE moderator_id=2 AND aktivno_od<'13:05' AND aktivno_do>'13:05'

#odabir svih zahtjeva korisnika 3
SELECT 
(SELECT naziv FROM valuta WHERE valuta_id=prodajem_valuta_id) as prodajem,
(SELECT naziv FROM valuta WHERE valuta_id=kupujem_valuta_id) as kupujem,
iznos as prodajni_iznos, prihvacen FROM zahtjev WHERE korisnik_id=3

#odabir svih neprihvaćenih zahtjeva sa vremenom rada prodjane valute za koje je zadužem moderator 2
SELECT z.*, v.naziv, v.tecaj, v.aktivno_od, v.aktivno_do FROM zahtjev z, valuta v 
WHERE z.prodajem_valuta_id = v.valuta_id AND v.moderator_id=2 AND z.prihvacen=0

#Odabir iznosa prodanih valuta na temelju prihvaćenih zahtjeva filtirano za moderatora 2 koji je prihvaztio zahtjev 
SELECT v.naziv, SUM(z.iznos) as ukupno_prodani_iznos FROM valuta v, zahtjev z 
WHERE v.valuta_id=z.prodajem_valuta_id AND z.prihvacen=1 AND moderator_id=2
GROUP BY v.valuta_id ORDER BY ukupno_prodani_iznos DESC

#Odabir iznosa prodanih valuta na temelju prihvaćenih zahtjeva filtirano za moderatora 2 koji je prihvaztio zahtjev  i vremenskog razdoblja kreiranja zahtjeva. 
SELECT v.naziv, SUM(z.iznos) as ukupno_prodani_iznos FROM valuta v, zahtjev z 
WHERE v.valuta_id=z.prodajem_valuta_id AND z.prihvacen=1 AND moderator_id=2 
AND datum_vrijeme_kreiranja BETWEEN '2018-01-01 00:00:00' AND '2018-12-31 23:55:55'
GROUP BY v.valuta_id ORDER BY ukupno_prodani_iznos DESC
