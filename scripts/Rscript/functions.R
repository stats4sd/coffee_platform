library(tidyverse)
library(openxlsx)
library(kableExtra)
library(knitr)
library(scales)

details_table <- function(x){
  data <- data%>%
    filter(Indicator == x)
  
  details_table <- tibble(
    Detail = c("Indicator", "Definition", "Indicator unit", "Internal indicator code",
               "Member of"))
  details_table$Comment[1] <- data$Indicator.name[1]
  details_table$Comment[2] <- data$Indicator.definition[1]
  details_table$Comment[3] <- "%"
  details_table$Comment[4] <- data$Indicator[1]
  details_table$Comment[5] <- "Key farm characteristics"
  
  details_country <- tibble(Detail = rep("Countries included", length(unique(data$Country))),
                            Comment = sort(unique(data$Country)))
  
  details_year <- tibble(Detail = rep("Years included", length(unique(data$Year))),
                         Comment = sort(unique(data$Year)))
  
  details_table <- rbind(details_table, details_country)%>%
    rbind(details_year)
  
  return(details_table)
}

indicator_table <- function(x){
  data <- data%>%
    filter(Indicator == x)
  
  Indicator_table <- data%>%
    select(Country, Source, Year, Value)%>%
    arrange(Year, Country)
  
  Indicator_table <- Indicator_table%>%
    pivot_wider(id_cols = Country:Source, names_from = Year,
                values_from = Value)
  
  Indicator_table <- Indicator_table %>%
    mutate(across(everything(), as.character))
  
  Indicator_table[is.na(Indicator_table)] <- ""
  
  return(Indicator_table)
  
}


bar_graph <- function(x){

  data <- data%>%
    filter(Indicator == x)  
  
 p1 <- ggplot(data,
       aes(fill = Country, y = Value/100, x = reorder(Year,desc(Year))))+
  geom_col(position = position_dodge(preserve = "single"))+
  scale_fill_brewer(palette = "Dark2")+
  coord_flip()+
  labs(x = "Year",
       y = paste(data$Indicator.name[1]))+
  scale_y_continuous(labels = percent)
 
 return(p1)
  
}

  